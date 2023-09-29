<template>
    <div>
      <h1>{{ title }}</h1>
      <p>{{ subtitle }}</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      title: String,
      subtitle: String,
    },
    model: {
      prop: 'title',
      event: 'titleChange',
    },
  };
  </script>