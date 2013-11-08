LESS_SOURCE = ./webroot/css/less/tiny_admin.less
CSS_TARGET = ./webroot/css/tiny_admin.min.css

build:
	@recess --compress --compile ${LESS_SOURCE} > ${CSS_TARGET}
