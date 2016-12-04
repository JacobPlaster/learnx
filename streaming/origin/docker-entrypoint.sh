#!/bin/bash
set -e
PATH_TO_CONFIG=/config/nginx.conf

	if [ "$API_HOST" ]; then
		sed -i -e "s/{'API_HOST'}/$API_HOST/g" $PATH_TO_CONFIG
		echo 'Pull host templated to: $PULL_HOST'
	else
		echo >&2 'You need to set the API_HOST environment variable.'
		exit 1
	fi

	cat /config/nginx.conf


exec "$@"
