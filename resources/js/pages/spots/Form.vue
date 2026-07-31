<template>
  <AppLayout title="Création d'un nouveau spot">
    <template #header>
      <h2 class="text-xl leading-tight font-semibold text-gray-800">Nouveau Spot</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <FormSection @submitted="submit">
          <template #title>Information du spot</template>

          <template #description>
            Renseigner les différentes informations concernant le spot.
          </template>

          <template #form>
            <div class="col-span-6 sm:col-span-4">
              <Label for="name" value="Nom" />
              <JetInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                minlength="5"
              />
              <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <Label for="lng" value="Longitude" />
              <JetInput
                id="lng"
                type="number"
                class="mt-1 block w-full"
                v-model="form.lng"
                required
                min="-180"
                max="180"
              />
              <InputError :message="form.errors.lng" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <Label for="lat" value="Latitude" />
              <JetInput
                id="lat"
                type="number"
                class="mt-1 block w-full"
                v-model="form.lat"
                required
                min="-180"
                max="180"
              />
              <InputError :message="form.errors.lat" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
              <Label for="optimal_wind_direction" value="Meilleur orientation du vent (en degré)" />
              <JetInput
                id="optimal_wind_direction"
                type="number"
                class="mt-1 block w-full"
                v-model="form.optimal_wind_direction"
                required
                min="0"
                max="360"
              />
              <InputError :message="form.errors.optimal_wind_direction" class="mt-2" />
            </div>
          </template>

          <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">Sauvegardé.</ActionMessage>

            <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Sauvegarder
            </Button>
          </template>
        </FormSection>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import Button from '@/components/ui/buttons/Button.vue'
import ActionMessage from '@/jetstream/ActionMessage.vue'
import FormSection from '@/jetstream/FormSection.vue'
import JetInput from '@/jetstream/Input.vue'
import InputError from '@/jetstream/InputError.vue'
import Label from '@/jetstream/Label.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { store as spotStore } from '@/routes/spots'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: null as string | null,
  lng: null as number | null,
  lat: null as number | null,
  optimal_wind_direction: null as number | null,
})

const submit = () => {
  console.log('submit')
  form.submit(spotStore())
}
</script>
