<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link, useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    const form = useForm({
        name: '',
        email: '',
        document: '',
        city: '',
        state: '',
        start_date: '',
    });

    const submit = () => {
        form.post(route('clients.store'), {
            onFinish: () => form.redirect('clients.index'),
        });
    };
</script>
<template>
    <AppLayout title="Client Create">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Client Create
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form @submit.prevent="submit">
                        <div class="mt-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="document" value="Document" />
                            <TextInput
                                id="document"
                                v-model="form.document"
                                type="text"
                                class="mt-1 block w-full"
                                maxlength="11"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.document" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="city" value="City" />
                            <TextInput
                                id="city"
                                v-model="form.city"
                                type="text"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.city" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="state" value="State" />
                            <TextInput
                                id="state"
                                v-model="form.state"
                                type="text"
                                class="mt-1 block w-full"
                                maxlength="2"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.state" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="start_date" value="Start Date" />
                            <TextInput
                                id="start_date"
                                v-model="form.start_date"
                                type="date"
                                class="mt-1 block w-full"
                                maxlength="2"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.start_date" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <Link :href="route('clients.index')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Cancel
                            </Link>

                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                create
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
