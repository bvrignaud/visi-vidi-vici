<template>
  <span>
    <span @click="startConfirmingPassword">
      <slot />
    </span>

    <jet-dialog-modal :show="confirmingPassword" @close="closeModal">
      <template #title>
        {{ title }}
      </template>

      <template #content>
        {{ content }}

        <div class="mt-4">
          <jet-input
            type="password"
            class="mt-1 block w-3/4"
            placeholder="Password"
            ref="password"
            v-model="form.password"
            @keyup.enter="confirmPassword"
          />

          <jet-input-error :message="form.error" class="mt-2" />
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="closeModal"> Cancel </jet-secondary-button>

        <Button
          class="ml-2"
          @click="confirmPassword"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          {{ button }}
        </Button>
      </template>
    </jet-dialog-modal>
  </span>
</template>

<script>
import Button from '@/components/ui/buttons/Button.vue'
import { defineComponent } from 'vue'
import JetSecondaryButton from '../components/ui/buttons/SecondaryButton.vue'
import JetDialogModal from '../components/ui/modal/DialogModal.vue'
import JetInput from './Input.vue'
import JetInputError from './InputError.vue'

export default defineComponent({
  emits: ['confirmed'],

  props: {
    title: {
      default: 'Confirmez votre mot de passe',
    },
    content: {
      default: 'For your security, please confirm your password to continue.',
    },
    button: {
      default: 'Confirm',
    },
  },

  components: {
    Button,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingPassword: false,
      form: {
        password: '',
        error: '',
      },
    }
  },

  methods: {
    startConfirmingPassword() {
      axios.get(route('password.confirmation')).then((response) => {
        if (response.data.confirmed) {
          this.$emit('confirmed')
        } else {
          this.confirmingPassword = true

          setTimeout(() => this.$refs.password.focus(), 250)
        }
      })
    },

    confirmPassword() {
      this.form.processing = true

      axios
        .post(route('password.confirm'), {
          password: this.form.password,
        })
        .then(() => {
          this.form.processing = false
          this.closeModal()
          this.$nextTick(() => this.$emit('confirmed'))
        })
        .catch((error) => {
          this.form.processing = false
          this.form.error = error.response.data.errors.password[0]
          this.$refs.password.focus()
        })
    },

    closeModal() {
      this.confirmingPassword = false
      this.form.password = ''
      this.form.error = ''
    },
  },
})
</script>
