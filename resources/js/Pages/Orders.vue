<template>
  <div class="p-4">
    <h1 class="text-center text-2xl font-bold m-4">Mini Order Management</h1>

    <orderForm @order-created="fetchOrders" />
    <orderTable :orders="orders" @status-updated="fetchOrders" />
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import orderForm from './components/OrderForm.vue'
import orderTable from './components/OrderTable.vue'

const orders = ref([])
const fetchOrders = async () => {
    const res = await axios.get('/api/orders')
    orders.value = res.data
}
onMounted(fetchOrders)
</script>
