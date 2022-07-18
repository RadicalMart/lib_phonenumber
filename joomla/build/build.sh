LIB_PATH_ROOT=$(realpath $PWD/../..)
LIB_PATH_LIBRARY=$(realpath $LIB_PATH_ROOT/joomla/library)
LIB_PATH_PLUGIN=$(realpath $LIB_PATH_ROOT/joomla/plugin)
LIB_PATH_PKG=$(realpath $LIB_PATH_ROOT/joomla)

cp -r $LIB_PATH_ROOT/LICENSE $LIB_PATH_ROOT/src $LIB_PATH_ROOT/vendor $LIB_PATH_LIBRARY

ls -l $LIB_PATH_LIBRARY

(cd $LIB_PATH_PKG && zip -r - library plugin language pkg_phonenumber.xml) > $PWD/pkg_phonenumber.zip