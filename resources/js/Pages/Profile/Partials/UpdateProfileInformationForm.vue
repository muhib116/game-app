<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';

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
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.post(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div>
                <label class="relative flex gap-4 items-center border px-5 py-2 rounded-lg w-fit bg-sky-400 text-white font-bold shadow-lg cursor-pointer">
                    Upload Logo/Profile
                    <svg class="w-6 h-6" width="800" height="800" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M21 16a1 1 0 0 1 .993.883L22 17v2a3 3 0 0 1-2.824 2.995L19 22H5a3 3 0 0 1-2.995-2.824L2 19v-2a1 1 0 0 1 1.993-.117L4 17v2a1 1 0 0 0 .883.993L5 20h14a1 1 0 0 0 .993-.883L20 19v-2a1 1 0 0 1 1-1ZM11.852 2.011l.058-.007L12 2l.075.003.126.017.111.03.111.044.098.052.104.074.082.073 3 3a1 1 0 1 1-1.414 1.414L13 5.414V15a1 1 0 0 1-2 0V5.414L9.707 6.707a1 1 0 0 1-1.414-1.414l3-3a.927.927 0 0 1 .112-.097l.11-.071.114-.054.105-.035.118-.025Z"/></svg>
                    <input
                        id="logo"
                        type="file"
                        class="mt-1 block w-full opacity-0 absolute"
                        @change="(e)=> form.logo = e.target.files[0]"
                    />
                </label>

                <InputError class="mt-2" :message="form.errors.logo" />
            </div>

            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
