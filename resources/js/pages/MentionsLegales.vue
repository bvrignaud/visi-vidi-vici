<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <app-layout title="Mentions légales">
    <template #header>
      <h1 class="text-xl font-semibold leading-tight text-gray-800">Mentions légales</h1>
    </template>
    <div class="bg-gray-100 px-6 py-12">
      <div class="mx-auto max-w-7xl rounded-lg bg-white p-8 shadow-md">
        <section class="mb-6">
          <h2 class="mb-2 text-xl font-semibold">Informations Générales</h2>
          <p><strong>Nom du site/application :</strong> Visi vidi vici</p>
          <p><strong>Responsable de la publication :</strong> Benoit VRIGNAUD</p>
          <p><strong>Adresse électronique :</strong> benoit.vrignaud@tangue.fr</p>
          <p>
            <strong>Hébergeur :</strong><br />
            Nom : OVH <br />
            Adresse : 2 Rue Kellermann, 59100 Roubaix, France <br />
            Téléphone : +33 9 72 10 10 07 <br />
            Site web :
            <a href="https://www.ovhcloud.com" class="text-blue-500 underline" target="_blank">
              https://www.ovhcloud.com
            </a>
          </p>
        </section>

        <section class="mb-6">
          <h2 class="mb-2 text-xl font-semibold">Propriété Intellectuelle</h2>
          <p>
            L'intégralité du contenu de ce site/application, y compris les textes, images, vidéos,
            graphiques, logos et icônes, est la propriété exclusive de
            <strong>Visi vidi vici</strong> ou fait l'objet d'une autorisation d'utilisation. Toute
            reproduction, distribution, modification ou utilisation partielle ou totale de ces
            contenus est strictement interdite sans l'autorisation préalable de
            <strong>Visi vidi vici</strong>.
          </p>
        </section>

        <!--        <section class="mb-6">-->
        <!--          <h2 class="mb-2 text-xl font-semibold">Données Personnelles</h2>-->
        <!--          <p>-->
        <!--            Conformément à la réglementation en vigueur, notamment le-->
        <!--            <strong>Règlement Général sur la Protection des Données (RGPD)</strong>, vos données-->
        <!--            personnelles collectées sur le site/application <strong>Visi vidi vici</strong> sont-->
        <!--            utilisées exclusivement dans le cadre défini dans notre-->
        <!--            <Link :href="'/politique-de-confidentialite'" class="text-blue-500 underline"-->
        <!--              >Politique de Confidentialité-->
        <!--            </Link>-->
        <!--          </p>-->
        <!--          <p>-->
        <!--            Vous disposez d'un droit d'accès, de rectification, de suppression et d'opposition à vos-->
        <!--            données personnelles. Vous pouvez exercer ces droits en nous contactant :-->
        <!--          </p>-->
        <!--          <ul class="mt-2 list-inside list-disc">-->
        <!--            <li><strong>Email :</strong> benoit.vrignaud@tangue.fr</li>-->
        <!--            <li><strong>Adresse postale :</strong> 16 La brosse Maçon, 85150 VAIRÉ</li>-->
        <!--          </ul>-->
        <!--        </section>-->

        <section class="mb-6">
          <h2 class="mb-2 text-xl font-semibold">Cookies</h2>
          <p>
            Pour améliorer l'expérience utilisateur
            <!--            et analyser le trafic-->
            , le site
            <strong>Visi vidi vici</strong> utilise des cookies. Vous pouvez configurer votre
            navigateur pour restreindre ou bloquer l'utilisation des cookies.
            <!--            Pour plus d'informations, veuillez consulter notre-->
            <!--            <Link :to="'/politique-de-cookies'" class="text-blue-500 underline">-->
            <!--              Politique de Cookies-->
            <!--            </Link>-->
            <!--            .-->
          </p>
        </section>

        <section class="mb-6">
          <h2 class="mb-2 text-xl font-semibold">Limitation de Responsabilité</h2>
          <p>
            <strong>Visi vidi vici</strong> s'efforce de fournir des informations exactes et à jour
            sur son site/application. Cependant, nous ne pouvons garantir l'exactitude, la
            complétude ou l'actualisation des contenus publiés. L'utilisation des informations
            présentes sur ce site/app est sous votre entière responsabilité.
            <strong>Visi vidi vici</strong> ne pourra être tenue responsable de tout dommage
            résultant de l'utilisation de son site/application.
          </p>
        </section>

        <section>
          <h2 class="mb-2 text-xl font-semibold">Contact</h2>
          <p>
            Pour toute question ou réclamation, vous pouvez nous contacter via notre page de
            <Link :href="route('contact')">contact</Link>
            .
          </p>
        </section>
      </div>
    </div>
  </app-layout>
</template>
