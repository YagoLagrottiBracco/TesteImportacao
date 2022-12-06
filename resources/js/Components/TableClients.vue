<script setup>
    import { useForm } from '@inertiajs/inertia-vue3';
    import ButtonForms from '@/Components/ButtonForms.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import Pagination from '@/Components/Pagination.vue'

    const props = defineProps({
        clients: Object,
    });

    const form = useForm();
</script>
<template>
    <div class="mt-8 flex gap-x-4 mb-5 ml-2" v-if="(props.clients.data.length > 0)">
        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 text-white">
            <thead class="bg-gray-100 dark:bg-gray-500 text-gray-300">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Document</th>
                    <th>City</th>
                    <th>Start Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <tr v-for="client in props.clients.data">
                    <td>{{client.id}}</td>
                    <td>{{client.name}}</td>
                    <td>{{client.email}}</td>
                    <td>{{client.document}}</td>
                    <td>{{client.city}} - {{client.state}}</td>
                    <td>{{client.start_date}}</td>
                    <td>
                        <div class="flex flex-row">
                            <ButtonForms message="Edit" :href="route('clients.edit', client.id)" color="indigo"/>
                            
                            <form @submit.prevent="form.delete(route('clients.destroy', client.id))">
                                <PrimaryButton class="m-8" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Delete
                                </PrimaryButton>
                            </form>
                        </div>
                    </td>
                </tr>
                    <Pagination class="mt-6" :links="clients.links" />
            </tbody>
        </table>
    </div>
    <div class="mt-8 flex gap-x-4 mb-5 ml-2 text-center justify-center" v-else>
        <span>NO DATA FOUND</span>
    </div>
</template>