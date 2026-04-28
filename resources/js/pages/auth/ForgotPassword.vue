<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { email } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Mot de passe oublié"
        description="Saisissez votre adresse e-mail pour recevoir un lien de réinitialisation"
    >
        <Head title="Mot de passe oublié" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <div class="space-y-6">
            <Form v-bind="email.form()" v-slot="{ errors, processing }">
                <div class="grid gap-2">
                    <Label for="email" class="text-slate-700 dark:text-slate-300">Adresse e-mail</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        autocomplete="off"
                        autofocus
                        placeholder="nom@exemple.com"
                        class="rounded-xl border-slate-200 dark:border-slate-800 focus:ring-blue-500"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="my-6 flex items-center justify-start">
                    <Button
                        class="w-full h-11 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg shadow-blue-600/20 transition-all active:scale-95"
                        :disabled="processing"
                        data-test="email-password-reset-link-button"
                    >
                        <Spinner v-if="processing" />
                        Envoyer le lien
                    </Button>
                </div>
            </Form>

            <div class="space-x-1 text-center text-sm text-slate-600 dark:text-slate-400">
                <span>Ou, retourner à la</span>
                <TextLink :href="login()" class="font-semibold text-blue-600 dark:text-blue-400">connexion</TextLink>
            </div>
        </div>
    </AuthLayout>
</template>
