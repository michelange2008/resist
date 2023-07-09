import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'
// Initialization for ES Users
import {
    Modal,
    Ripple,
    initTE,
  } from 'tw-elements';
  
  initTE({ Modal, Ripple });
window.Alpine = Alpine;

Alpine.plugin(focus)
Alpine.start();
