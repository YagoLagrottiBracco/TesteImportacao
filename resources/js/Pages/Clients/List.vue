<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/inertia-vue3';
    import TableClients from '@/Components/TableClients.vue';
    import ButtonForms from '@/Components/ButtonForms.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';

    defineProps({
        clients: Array,
    });

    const form = useForm({
        import: [],
    });

    const submit = () => {
        form.post(route('clients.import'), {
            onFinish: () => form.reset(),
            forceFormData: true,
        });
    };
</script>
<template>
    <AppLayout title="Clients">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clients
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-row">
                        <ButtonForms message="Create New User" :href="route('clients.create')" color="indigo"/>
                    </div>
                    <div class="mx-4">
                        <form  @submit.prevent="submit">
                            <InputLabel for="import" value="Import file" />
                            <TextInput
                                id="import"
                                @input="form.import = $event.target.files[0]"
                                type="file"
                                class="mt-1 text-white rounded-lg bg-red-600"
                            />
                            <div v-for="error in form.errors">
                                <InputError class="mt-2" :message="error" />
                            </div>
                            <button type="submit" class="ml-2 inline-block rounded-lg bg-red-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-red-600 hover:bg-red-700 hover:ring-red-700">Send</button>
                        </form>
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                    </div>
                    <TableClients :clients="clients"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
