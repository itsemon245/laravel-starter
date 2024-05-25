import { createApp } from "vue/dist/vue.esm-bundler";
import * as components from './components/generated.json';
import Str from 'lodash/string';


const app = createApp({})
Object.entries(components).forEach(([name, file]) => {
  let kebabName = Str.kebabCase(name);
  if (name != 'default') {
    import(`./components/${name}.vue`).then(mod => {
      app.component(`${kebabName}`, mod);
    }).catch(err => {
      console.error(`Failed to load component ${name} from file ${file}:`, err);
    });
  }
});
app.mount('#vue-root');