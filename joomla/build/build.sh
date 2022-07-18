#!/usr/bin/env bash

LIB_PWD=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

LIB_PATH_ROOT=$(realpath $LIB_PWD/../..)
LIB_PATH_PKG=$(realpath $LIB_PATH_ROOT/joomla)
LIB_PATH_LIBRARY=$(realpath $LIB_PATH_PKG/library)
LIB_PATH_PLUGIN=$(realpath $LIB_PATH_PKG/plugin)

cp -r $LIB_PATH_ROOT/LICENSE $LIB_PATH_ROOT/src $LIB_PATH_ROOT/vendor $LIB_PATH_LIBRARY

(cd $LIB_PATH_PKG && zip -r - library plugin language pkg_phonenumber.xml) > $LIB_PWD/pkg_phonenumber.zip