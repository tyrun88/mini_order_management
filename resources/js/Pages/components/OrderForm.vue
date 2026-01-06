<template>
    <h3>Order Form</h3>
  <form @submit.prevent="submitOrder" class="flex flex-wrap items-end gap-4 mb-6">
    <div class="flex-1">
        <input
        v-model="form.customer_name"
        type="text"
        placeholder="Customer Name"
        class="border p-2 rounded w-full"
        />
        <p v-if="errors.customer_name" class="text-red-500 text-sm">{{ errors.customer_name }} </p>
    </div>
    <div class="flex-1">
        <input
        v-model="form.item_name"
        type="text"
        placeholder="Item Name"
        class="border p-2 rounded w-full"
        />
        <p v-if="errors.item_name" class="text-red-500 text-sm">{{ errors.item_name }} </p>
    </div>
    <div class="flex-1">
         <input
        v-model.number="form.price"
        type="number"
        placeholder="Price"
        class="border p-2 rounded w-full"
        />
        <p v-if="errors.price" class="text-red-500 text-sm">{{ errors.price }} </p>
    </div>  
    <div class="flex-1">
        <select
        v-model="form.status"
        class="border p-2 rounded w-full"
        >
        <option value="pending">Pending</option>
        <option value="paid">Paid</option>
        <option value="cancelled">Cancelled</option>
        </select>
        <p v-if="errors.status" class="text-red-500 text-sm">{{ errors.status }} </p>
    </div>
    <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
        >
        Submit
        </button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const emit = defineEmits(['order-created'])

const form = ref({
  customer_name: '',
  item_name: '',
  price: '',
  status: 'pending',
})

const errors=ref({});

const submitOrder = async () => {
    errors.value={}
  try {
    await axios.post('/api/orders', form.value)
    form.value = {customer_name:'',item_name:'',price:'',status:'pending'}
    emit('order-created')
  } catch (error) {
    if(error.response?.status === 422) {
        errors.value = error.response.data.errors
    }
  }
}
</script>
