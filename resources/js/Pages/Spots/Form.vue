<template>
    <app-layout title="Création d'un nouveau spot">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nouveau Spot</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <FormSection @submitted="submit">
                    <template #title>
                        Information du spot
                    </template>

                    <template #description>
                        Renseigner les différentes informations concernant le spot.
                    </template>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <Label for="name" value="Nom" />
                            <JetInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                      required minlength="5"/>
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <Label for="lng" value="Longitute" />
                            <JetInput id="lng" type="number" class="mt-1 block w-full" v-model="form.lng"
                                      required min="-180" max="180" />
                            <InputError :message="form.errors.lng" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <Label for="lat" value="Longitute" />
                            <JetInput id="lat" type="number" class="mt-1 block w-full" v-model="form.lat"
                                      required min="-180" max="180" />
                            <InputError :message="form.errors.lat" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                            Sauvegardé.
                        </ActionMessage>

                        <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Sauvegarder
                        </Button>
                    </template>
                </FormSection>
            </div>
        </div>
    </app-layout>
</template>


<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import Label from "@/Jetstream/Label";
import InputError from "@/Jetstream/InputError";
import ActionMessage from "@/Jetstream/ActionMessage";
import Button from "@/Jetstream/Button";

export default defineComponent({
    components: {
        Button,
        ActionMessage,
        InputError,
        JetInput,
        Label,
        FormSection,
        AppLayout,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                lng: null,
                lat: null,
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(route('spots.create'));
        }
    }
})
</script>
