<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="メールアドレス" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="パスワード" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">ログイン情報を保存する</span>
                </label>
            </div>

            <div class="flex flex-wrap items-center justify-center mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="mr-2 underline text-sm text-gray-600 hover:text-gray-900">
                    パスワードを忘れた方はこちら
                </Link>
                <Link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    新規登録はこちら
                </Link>

                <BreezeButton class="ml-4 mt-4 " :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    ログイン
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
