<template>
  <app-layout title="Webcams">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Webcams</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 mt-5">
          <Map :markers="markers" :link-on-marker="true"/>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import AppLayout from "../../Layouts/AppLayout.vue";
import Map from "../../Components/Map.vue"
import {onMounted, ref} from "vue";
import Marker from "../../Types/Marker";

const markers = ref<Array<Marker>>([]);

onMounted(async () => {
  fetch(`/api/webcams`)
    .then(response => response.json())
    .then(data => {
      markers.value = data.data.map((webcam: object) => {
        return {
          id: webcam.id,
          coordinates: [webcam.lat, webcam.lng],
          options: {title: webcam.title},
          url: webcam.url,
        };
      });
    })
});
</script>
