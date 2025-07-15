<script setup lang="ts">
import CircleButton from '@/components/ui/buttons/CircleButton.vue'
import { logEvent } from 'histoire/client'
import '../../../../css/app.css'
</script>

<template>
  <Story title="Ui/Buttons/CircleButton" :layout="{ type: 'grid', width: 200 }">
    <Variant title="default">
      <circle-button @click="logEvent('click', $event)" />
    </Variant>
    <Variant title="Prev">
      <circle-button>❮</circle-button>
    </Variant>
    <Variant title="Next">
      <circle-button>❯</circle-button>
    </Variant>
  </Story>
</template>

<docs lang="md">
# CircleButton

```vue
<template>
  <circle-button />
</template>
```
</docs>
