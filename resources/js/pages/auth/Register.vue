<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';
import { Form, Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthBase
        title="Créer un compte"
        description="Saisissez vos informations pour rejoindre la plateforme"
    >
        <Head title="Inscription" />

        <Form
            v-bind="store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name" class="text-slate-700 dark:text-slate-300">Nom complet</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        name="name"
                        placeholder="Votre nom"
                        class="rounded-xl border-slate-200 dark:border-slate-800 focus:ring-blue-500"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email" class="text-slate-700 dark:text-slate-300">Adresse e-mail</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        :tabindex="2"
                        autocomplete="email"
                        name="email"
                        placeholder="nom@exemple.com"
                        class="rounded-xl border-slate-200 dark:border-slate-800 focus:ring-blue-500"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password" class="text-slate-700 dark:text-slate-300">Mot de passe</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        name="password"
                        placeholder="••••••••"
                        class="rounded-xl border-slate-200 dark:border-slate-800 focus:ring-blue-500"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation" class="text-slate-700 dark:text-slate-300">Confirmer le mot de passe</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        name="password_confirmation"
                        placeholder="••••••••"
                        class="rounded-xl border-slate-200 dark:border-slate-800 focus:ring-blue-500"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    class="mt-2 w-full h-11 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-600/20 transition-all active:scale-95"
                    tabindex="5"
                    :disabled="processing"
                    data-test="register-user-button"
                >
                    <Spinner v-if="processing" />
                    Créer le compte
                </Button>
            </div>

            <div class="text-center text-sm text-slate-600 dark:text-slate-400">
                Vous avez déjà un compte ?
                <TextLink
                    :href="login()"
                    class="font-semibold text-blue-600 dark:text-blue-400"
                    :tabindex="6"
                    >Se connecter</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
