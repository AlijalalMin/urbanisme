<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthBase
        title="Connexion"
        description="Saisissez vos identifiants pour accéder à votre espace"
    >
        <Head title="Connexion" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email" class="text-slate-700 dark:text-slate-300">Adresse e-mail</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="nom@exemple.com"
                        class="rounded-xl border-slate-200 dark:border-slate-800 focus:ring-blue-500"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password" class="text-slate-700 dark:text-slate-300">Mot de passe</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400"
                            :tabindex="5"
                        >
                            Mot de passe oublié ?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="rounded-xl border-slate-200 dark:border-slate-800 focus:ring-blue-500"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3 cursor-pointer">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span class="text-sm text-slate-600 dark:text-slate-400">Se souvenir de moi</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="mt-4 w-full h-11 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-600/20 transition-all active:scale-95"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" />
                    Se connecter
                </Button>
            </div>

            <div
                class="text-center text-sm text-slate-600 dark:text-slate-400"
                v-if="canRegister"
            >
                Vous n'avez pas de compte ?
                <TextLink :href="register()" :tabindex="5" class="font-semibold text-blue-600 dark:text-blue-400">S'inscrire</TextLink>
            </div>
        </Form>
    </AuthBase>
</template>
