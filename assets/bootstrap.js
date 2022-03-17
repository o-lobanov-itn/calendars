import { startStimulusApp } from '@symfony/stimulus-bridge';
import { topAppBar } from 'material-components-web';
import $ from 'jquery';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

$(document).ready(function() {
    topAppBar.MDCTopAppBar.attachTo(document.querySelector('.mdc-top-app-bar'));
});