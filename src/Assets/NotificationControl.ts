if (module.hot) {
	module.hot.accept();
}

import {mkNotifications, mkNoti} from './notify.js';

import {App, BaseComponent, SAGA_REDRAW_SNIPPET, Saga} from "Stage"
const SAGA_NOTIFICATION_REQUEST_STARTED = 'SAGA_NOTIFICATION_REQUEST_STARTED';

class NotificationControl extends BaseComponent {

	initial() {
		super.initial();
		this.installPlugins();
	}

	@Saga(SAGA_NOTIFICATION_REQUEST_STARTED)
	public installPlugins(action = null){
		if (action) {
			const {content, snippetName, response} = action.payload;
			let source = $(document).find('#' + snippetName);
			source.html(content);
			if (!window.notifications) {
				return;
			}

			mkNotifications(window.notifications.options);
			for (let notification of window.notifications.notifications) {
				mkNoti(
					notification.title,
					notification.message,
					{
						status: notification.status
					}
				);
			}

			App.store.dispatch({
				type: SAGA_REDRAW_SNIPPET,
				payload: {
					snippetName: snippetName,
					content : content,
					response: response
				}
			});
		} else  {
			if (!window.notifications) {
				return;
			}

			mkNotifications(window.notifications.options);
			for (let notification of window.notifications.notifications) {
				mkNoti(
					notification.title,
					notification.message,
					{
						status: notification.status
					}
				);
			}
		}
	}
}

App.addComponent("NotificationControl", NotificationControl);
