import { createRouter, createWebHistory } from 'vue-router';
import MainRoutes from './MainRoutes';
import AuthRoutes from './AuthRoutes';
import Auth from '@/components/auth/Auth.vue'

const routes = [
  {
      path: '/:pathMatch(.*)*',
      component: () => import('@/views/authentication/Error.vue')
  },
  MainRoutes,
  AuthRoutes
];

export const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
});

/**
 * Aciona uma chamada antes de inicializar o router, no caso específico
 * vamos utilizar o componente AuthGuard para validar o token a cada requisição
 * sendo que a cada requisição vamos refrescar o token para não deslogar
 * 
 * @author Husani Santos, Leonardo Fuzita
 * 
 */
router.beforeEach( async (to, from, next) => {
    
    const token = await Auth.check()

    if (to.name !== 'Login' && !token) {
      // Redireciona o usuário para a página de login se não estiver autenticado
      next({ name: 'Login' });
    } else {
      // Permite o acesso à rota protegida
      next();
    }
    
});