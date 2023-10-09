<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
  primaryColor: String,
  data: Object
});

function generatePagedUrl(baseUrl, page) {
  const url = new URL(baseUrl, window.location.origin);
  url.searchParams.set('page', page);
  return url.toString();
}
</script>

<template>
  <div v-if="data.links.length > 3" class="flex justify-center mb-4 mt-4 space-x-4">
    <!-- Renderiza apenas se o link "Previous" não for null -->
    <Link
      v-if="data.links[0].url !== null"
      class="px-2 py-1 text-sm leading-2 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
      :style="{
        'color': data.links[0].active ? 'white' : '',
        'background-color': data.links[0].active ? primaryColor : '',
      }"
      :href="generatePagedUrl(data.prev_page_url, data.current_page - 1)"
      v-html="'Anterior'"
    />
    
    <template v-for="(link, k) in data.links.slice(1, -1)">
      <Link
        class="px-2 py-1 text-sm leading-2 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
        :style="{
          'color': link.active ? 'white' : '',
          'background-color': link.active ? primaryColor : '',
        }"
        :href="generatePagedUrl(link.url, link.label)"
        v-html="link.label.includes('Previous') ? 'Anterior' : (link.label.includes('Next') ? 'Próximo' : link.label)"
      />
    </template>

    <Link
      v-if="data.links[data.links.length - 1].url !== null"
      class="px-2 py-1 text-sm leading-2 bg-white rounded hover:bg-white focus:text-indigo-500 hover:shadow"
      :style="{
        'color': data.links[data.links.length - 1].active ? 'white' : '',
        'background-color': data.links[data.links.length - 1].active ? primaryColor : '',
      }"
      :href="generatePagedUrl(data.next_page_url, data.current_page + 1)"
      v-html="'Próximo'"
    />
  </div>
</template>
