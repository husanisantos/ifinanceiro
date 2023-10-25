<script>
import { UserIcon, MailIcon, ListCheckIcon } from 'vue-tabler-icons';

export default {
  methods: {
    desconectar() {
      // Limpar o localStorage
      localStorage.removeItem("token");
      this.$router.push("/auth/login");
    }
  }
}
</script>

<template>
    <!-- ---------------------------------------------- -->
    <!-- notifications DD -->
    <!-- ---------------------------------------------- -->
    <v-menu :close-on-content-click="false">
        <template v-slot:activator="{ props }">
            <v-btn class="" variant="text" v-bind="props" icon>
                <v-avatar size="35">
                    <img src="@/assets/images/profile/user-1.jpg" height="35" alt="user" />
                </v-avatar>
            </v-btn>
        </template>
        <v-sheet rounded="xl" width="200" elevation="10" class="mt-2">
            <div class="pt-4 pb-4 px-5 text-center">
                <v-btn  @click="desconectar"  to="" color="primary" variant="outlined" class="rounded-pill" block>Desconectar</v-btn>
            </div>
        </v-sheet>
    </v-menu>
</template>
