
import Test from './components/ExampleComponent.vue';
import Orders from './components/Orders.vue';
import Fleets from './components/Fleet.vue';
import Shipments from './components/Shipment.vue';

export const routes = [
    {
        name: 'home',
        path: '/home',
        component: Test
    },
    {
        name: 'orders',
        path: '/orders',
        component: Orders
    },
    {
        name: 'shipment',
        path: '/shipment',
        component: Shipments
    },
    {
        name: 'fleets',
        path: '/fleet',
        component: Fleets
    },

];
