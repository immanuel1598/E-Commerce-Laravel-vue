<script setup>
import AdminLayout from '../Components/AdminLayout.vue';
import ProductList from './ProductList.vue';

defineProps({
    product:Array,
});
</script>

<template>
 <AdminLayout>
<ProductList product = "product"></ProductList>
 </AdminLayout>
</template>