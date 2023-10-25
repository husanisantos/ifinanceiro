<script setup lang="ts">
import { useRouter } from 'vue-router';
const props = defineProps({
    title: String,
    to: String
});

const router = useRouter();

const redirectToRoute = () => {
    if (props.to) {
        // Use o Vue Router para redirecionar para a rota especificada
        router.push(props.to);
    }
};
</script>

// ===============================|| Ui Parent Card||=============================== //
<template>
    <v-card elevation="10" >
        <v-card-item class="py-4 px-6">
            <div class="d-sm-flex align-center justify-space-between">
                <v-card-title class="text-h5 font-weight-semibold">
                    {{ title }}
                </v-card-title>
                <template v-if="props.to">
                    <!-- Mostra o botão somente se a prop 'to' estiver presente -->
                    <v-btn @click="redirectToRoute"  color="primary" flat>Adicionar</v-btn>
                </template>
                <!-- <template v-slot:append> -->
                <slot name="action"></slot>
                <!-- </template> -->
            </div>
        </v-card-item>
        <v-divider></v-divider>
        <v-card-text>
            <slot />
        </v-card-text>
    </v-card>
</template>
