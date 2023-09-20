<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
  primaryColor: String,
  data: Object
});
</script>


<template>
    <div v-if="data.links.length > 3" class="flex justify-center mb-4 mt-4 space-x-4">
        <Link
            v-for="(link, k) in data.links"
            :key="k"
            class="px-2 py-1 text-sm leading-2 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
            :style="{
              'color': link.active ? 'white' : '', // Define a cor do texto para 'white' se link.active for verdadeiro
              'background-color': link.active ? primaryColor : '', // Define a cor de fundo como primaryColor se link.active for verdadeiro
            }"
            :href="link.url"
            v-html="link.label.includes('Previous') ? 'Anterior' : (link.label.includes('Next') ? 'Próximo' : link.label)"
        />
    </div>
</template>