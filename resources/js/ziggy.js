import route from 'ziggy-js';
import { Ziggy } from './ziggy-generated.js'; // si lo generas manualmente

export default function (name, params, absolute) {
    return route(name, params, absolute, Ziggy);
}
