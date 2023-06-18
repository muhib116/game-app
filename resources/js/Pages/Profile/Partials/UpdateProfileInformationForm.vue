<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { translate } from '@/useLanguage';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.value.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    logo: null,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">{{ translate('Profile Information') }}</h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ translate(`Update your account's profile information and email address.`) }}
            </p>
        </header>

        <form @submit.prevent="form.post(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" :value="translate('Name')" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="translate(form.errors.name)" />
            </div>

            <div>
                <InputLabel for="email" :value="translate('Email')" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="translate(form.errors.email)" />
            </div>
            <div>
                <label class="relative flex gap-4 items-center border px-5 py-2 rounded w-fit bg-slate-200 shadow cursor-pointer">
                    {{ translate('Upload Logo/Profile') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path>
                    </svg>
                    <input
                        id="logo"
                        type="file"
                        class="mt-1 block w-full opacity-0 absolute cursor-pointer"
                        @change="(e)=> form.logo = e.target.files[0]"
                    />
                </label>
                <div class="text-red-500 mt-1">
                    {{ translate('Recommended Image size should be square (1:1)') }}
                </div>

                <InputError class="mt-2" :message="translate(form.errors.logo)" />
            </div>

            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    {{ translate('Your email address is unverified.') }}
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        {{ translate('Click here to re-send the verification email.') }}
                    </Link>
                </p>

                <div
                    v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    {{ translate('A new verification link has been sent to your email address.') }}
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">{{ translate('Save') }}</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ translate('Saved.') }}</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
