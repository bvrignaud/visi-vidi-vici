<template>
  <div>
    <!-- Generate API Token -->
    <jet-form-section @submitted="createApiToken">
      <template #title> Create API Token</template>

      <template #description>
        API tokens allow third-party services to authenticate with our application on your behalf.
      </template>

      <template #form>
        <!-- Token Name -->
        <div class="col-span-6 sm:col-span-4">
          <jet-label for="name" value="Name" />
          <jet-input
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="createApiTokenForm.name"
            autofocus
          />
          <jet-input-error :message="createApiTokenForm.errors.name" class="mt-2" />
        </div>

        <!-- Token Permissions -->
        <div class="col-span-6" v-if="availablePermissions.length > 0">
          <jet-label for="permissions" value="Permissions" />

          <div class="mt-2 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div v-for="permission in availablePermissions" :key="permission">
              <label class="flex items-center">
                <jet-checkbox
                  :value="permission"
                  v-model:checked="createApiTokenForm.permissions"
                />
                <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
              </label>
            </div>
          </div>
        </div>
      </template>

      <template #actions>
        <jet-action-message :on="createApiTokenForm.recentlySuccessful" class="mr-3">
          Created.
        </jet-action-message>

        <Button
          :class="{ 'opacity-25': createApiTokenForm.processing }"
          :disabled="createApiTokenForm.processing"
        >
          Create
        </Button>
      </template>
    </jet-form-section>

    <div v-if="tokens.length > 0">
      <jet-section-border />

      <!-- Manage API Tokens -->
      <div class="mt-10 sm:mt-0">
        <jet-action-section>
          <template #title> Manage API Tokens</template>

          <template #description>
            You may delete any of your existing tokens if they are no longer needed.
          </template>

          <!-- API Token List -->
          <template #content>
            <div class="space-y-6">
              <div
                class="flex items-center justify-between"
                v-for="token in tokens"
                :key="token.id"
              >
                <div>
                  {{ token.name }}
                </div>

                <div class="flex items-center">
                  <div class="text-sm text-gray-400" v-if="token.last_used_ago">
                    Last used {{ token.last_used_ago }}
                  </div>

                  <button
                    class="ml-6 cursor-pointer text-sm text-gray-400 underline"
                    @click="manageApiTokenPermissions(token)"
                    v-if="availablePermissions.length > 0"
                  >
                    Permissions
                  </button>

                  <button
                    class="ml-6 cursor-pointer text-sm text-red-500"
                    @click="confirmApiTokenDeletion(token)"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </template>
        </jet-action-section>
      </div>
    </div>

    <!-- Token Value Modal -->
    <jet-dialog-modal :show="displayingToken" @close="displayingToken = false">
      <template #title> API Token</template>

      <template #content>
        <div>Please copy your new API token. For your security, it won't be shown again.</div>

        <div
          class="mt-4 rounded-xs bg-gray-100 px-4 py-2 font-mono text-sm text-gray-500"
          v-if="$page.props.jetstream.flash.token"
        >
          {{ $page.props.jetstream.flash.token }}
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="displayingToken = false"> Close</jet-secondary-button>
      </template>
    </jet-dialog-modal>

    <!-- API Token Permissions Modal -->
    <jet-dialog-modal :show="managingPermissionsFor" @close="managingPermissionsFor = null">
      <template #title> API Token Permissions</template>

      <template #content>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div v-for="permission in availablePermissions" :key="permission">
            <label class="flex items-center">
              <jet-checkbox :value="permission" v-model:checked="updateApiTokenForm.permissions" />
              <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
            </label>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="managingPermissionsFor = null">
          Annuler
        </jet-secondary-button>

        <Button
          class="ml-2"
          @click="updateApiToken"
          :class="{ 'opacity-25': updateApiTokenForm.processing }"
          :disabled="updateApiTokenForm.processing"
        >
          Sauvegarder
        </Button>
      </template>
    </jet-dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <jet-confirmation-modal :show="apiTokenBeingDeleted" @close="apiTokenBeingDeleted = null">
      <template #title> Delete API Token</template>

      <template #content> Are you sure you would like to delete this API token?</template>

      <template #footer>
        <jet-secondary-button @click="apiTokenBeingDeleted = null"> Annuler</jet-secondary-button>

        <jet-danger-button
          class="ml-2"
          @click="deleteApiToken"
          :class="{ 'opacity-25': deleteApiTokenForm.processing }"
          :disabled="deleteApiTokenForm.processing"
        >
          Delete
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>
  </div>
</template>

<script>
import Button from '@/components/ui/buttons/Button.vue'
import JetDangerButton from '@/components/ui/buttons/DangerButton.vue'
import JetSecondaryButton from '@/components/ui/buttons/SecondaryButton.vue'
import JetConfirmationModal from '@/components/ui/modal/ConfirmationModal.vue'
import JetDialogModal from '@/components/ui/modal/DialogModal.vue'
import JetActionMessage from '@/jetstream/ActionMessage.vue'
import JetActionSection from '@/jetstream/ActionSection.vue'
import JetCheckbox from '@/jetstream/Checkbox.vue'
import JetFormSection from '@/jetstream/FormSection.vue'
import JetInput from '@/jetstream/Input.vue'
import JetInputError from '@/jetstream/InputError.vue'
import JetLabel from '@/jetstream/Label.vue'
import JetSectionBorder from '@/jetstream/SectionBorder.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    JetActionMessage,
    JetActionSection,
    Button,
    JetConfirmationModal,
    JetDangerButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetCheckbox,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    JetSectionBorder,
  },

  props: ['tokens', 'availablePermissions', 'defaultPermissions'],

  data() {
    return {
      createApiTokenForm: this.$inertia.form({
        name: '',
        permissions: this.defaultPermissions,
      }),

      updateApiTokenForm: this.$inertia.form({
        permissions: [],
      }),

      deleteApiTokenForm: this.$inertia.form(),

      displayingToken: false,
      managingPermissionsFor: null,
      apiTokenBeingDeleted: null,
    }
  },

  methods: {
    createApiToken() {
      this.createApiTokenForm.post(route('api-tokens.store'), {
        preserveScroll: true,
        onSuccess: () => {
          this.displayingToken = true
          this.createApiTokenForm.reset()
        },
      })
    },

    manageApiTokenPermissions(token) {
      this.updateApiTokenForm.permissions = token.abilities

      this.managingPermissionsFor = token
    },

    updateApiToken() {
      this.updateApiTokenForm.put(route('api-tokens.update', this.managingPermissionsFor), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (this.managingPermissionsFor = null),
      })
    },

    confirmApiTokenDeletion(token) {
      this.apiTokenBeingDeleted = token
    },

    deleteApiToken() {
      this.deleteApiTokenForm.delete(route('api-tokens.destroy', this.apiTokenBeingDeleted), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (this.apiTokenBeingDeleted = null),
      })
    },
  },
})
</script>
