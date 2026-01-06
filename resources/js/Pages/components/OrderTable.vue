<template>
  <div>
    <h3>Orders</h3>

    <table class="w-full border text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="border p-2 text-left">Customer Name</th>
          <th class="border p-2 text-left">Item Name</th>
          <th class="border p-2 text-right">Price</th>
          <th class="border p-2 text-left">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="order in orders"
          :key="order.id"
          class="border-t"
        >
          <td class="p-2">{{ order.customer_name }}</td>
          <td class="p-2">{{ order.item_name }}</td>
          <td class="p-2">{{ order.price.toFixed(2) }}</td>
          <td class="p-2">
            <select
              v-model="order.status"
              @change="updateStatus(order)"
              class="border p-1 rounded w-32"
            >
              <option disabled value="pending">Pending</option>
              <option value="paid">Paid</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </td>
        </tr>
        <tr v-if="orders.length === 0">
          <td colspan="4" class="text-center py-4">No orders found.</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import axios from 'axios'

const props = defineProps({
  orders: {
    type: Array,
    required: true,
  },
})

const emit = defineEmits(['status-updated'])

const updateStatus = async (order) => {
  try {
    await axios.patch(`/api/orders/${order.id}`, {
      status: order.status,
    })
    alert(`Status updated to "${order.status}" for ${order.customer_name}`)
    emit('status-updated')
  } catch (error) {
    console.error('Failed to update status:', error)
  }
}
</script>
