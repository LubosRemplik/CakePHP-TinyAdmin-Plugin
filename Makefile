LESS_SOURCE = ./webroot/css/less/tiny_admin.less
CSS_TARGET = ./webroot/css/tiny_admin.min.css
JS_TARGET = ./webroot/js/tiny_admin.min.js

build:
	@recess --compress --compile ${LESS_SOURCE} > ${CSS_TARGET}
	@cat \
		./webroot/js/jquery-1.10.2.min.js \
		./webroot/js/jquery-ui-1.10.3.custom.min.js \
		./webroot/js/jquery.cookie.js \
		./../Twbs/webroot/bootstrap/dist/js/bootstrap.min.js \
		> ${JS_TARGET}.tmp
	@uglifyjs -nc \
		${JS_TARGET}.tmp \
		> ${JS_TARGET} 
	@rm ${JS_TARGET}.tmp
