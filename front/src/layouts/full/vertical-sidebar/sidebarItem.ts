import {
  LayoutDashboardIcon,BorderAllIcon,
  AlertCircleIcon,
  CircleDotIcon,
  BoxMultiple1Icon,
  LoginIcon, MoodHappyIcon, ApertureIcon, UserPlusIcon
} from 'vue-tabler-icons';

import { IconCards } from '@tabler/icons-vue';

export interface menu {
  header?: string;
  title?: string;
  icon?: any;
  to?: string;
  chip?: string;
  BgColor?: string;
  chipBgColor?: string;
  chipColor?: string;
  chipVariant?: string;
  chipIcon?: string;
  children?: menu[];
  disabled?: boolean;
  type?: string;
  subCaption?: string;
}

const sidebarItem: menu[] = [
  { header: 'Home' },
  {
    title: 'Painel de controle',
    icon: LayoutDashboardIcon,
    BgColor: 'primary',
    to: '/'
  },
  { header: 'Gestão' },
  {
    title: "Contas a pagar",
    icon: IconCards,
    BgColor: 'primary',
    to: "/contas/pagar",    
  }
];

export default sidebarItem;
