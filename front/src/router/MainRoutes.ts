const MainRoutes = {
    path: '/main',
    meta: {
        requiresAuth: true
    },
    redirect: '/main',
    component: () => import('@/layouts/full/FullLayout.vue'),
    children: [
        {
            name: 'Dashboard',
            path: '/',
            component: () => import('@/views/dashboard/index.vue')
        },
        {
            name: 'contas-pagar',
            path: '/contas/pagar',
            component: () => import('@/views/pages/contas/Index.vue')
        },
        {
            name: 'contas-pagar-adicionar',
            path: '/contas/pagar/adicionar',
            component: () => import('@/views/pages/contas/Adicionar.vue')
        },
        {
            name: 'contas-pagar-editar', 
            path: '/contas/pagar/editar/:id', 
            component: () => import('@/views/pages/contas/Editar.vue') 
        },
        {
            name: 'contas-pagar-excluir', 
            path: '/contas/pagar/excluir/:id', 
            component: () => import('@/views/pages/contas/Excluir.vue') 
        },
        {
            name: 'Buttons',
            path: '/ui/buttons',
            component: () => import('@/views/ui-components/Buttons.vue')
        },
        {
            name: 'Cards',
            path: '/ui/cards',
            component: () => import('@/views/ui-components/Cards.vue')
        },
        {
            name: 'Tables',
            path: '/ui/tables',
            component: () => import('@/views/ui-components/Tables.vue')
        },
        {
            name: 'Icons',
            path: '/icons',
            component: () => import('@/views/pages/Icons.vue')
        },
        {
            name: 'Starter',
            path: '/sample-page',
            component: () => import('@/views/pages/SamplePage.vue')
        },
       
    ]
};

export default MainRoutes;
