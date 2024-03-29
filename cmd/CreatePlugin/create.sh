#!/usr/bin/env bash
echo -e "\033[1;34m ##################################################### \033[0m"
echo -e "\033[1;34m # Plugin sample for WordPress development           # \033[0m"
echo -e "\033[1;34m #                                                   # \033[0m"
echo -e "\033[1;34m # Author:   juanmacivico87                          # \033[0m"
echo -e "\033[1;34m # Website:  https://www.juanmacivico87.com          # \033[0m"
echo -e "\033[1;34m # GitHub:   https://www.github.com/juanmacivico87   # \033[0m"
echo -e "\033[1;34m ##################################################### \033[0m"

echo ""
echo -e "\033[1;34m Let's go there. Start plugin configuration!!! \033[0m"

cd ../..
source .data

rm -r -f .git
rm -f readme.md
echo "# $PLUGIN_NAME" > readme.md

mv "plugin-sample.php" "$PLUGIN_SLUG.php"

grep -rl "{{ plugin_name }}" | xargs sed -i "s/{{ plugin_name }}/$PLUGIN_NAME/g"
grep -rl "{{ plugin_description }}" | xargs sed -i "s/{{ plugin_description }}/$PLUGIN_DESCRIPTION/g"
grep -rl "{{ plugin_uri }}" | xargs sed -i "s/{{ plugin_uri }}/$PLUGIN_URI/g"
grep -rl "{{ plugin_author }}" | xargs sed -i "s/{{ plugin_author }}/$PLUGIN_AUTHOR/g"
grep -rl "{{ plugin_author_uri }}" | xargs sed -i "s/{{ plugin_author_uri }}/$PLUGIN_AUTHOR_URI/g"
grep -rl "{{ plugin_slug }}" | xargs sed -i "s/{{ plugin_slug }}/$PLUGIN_SLUG/g"
grep -rl "plugin/sample" | xargs sed -i "s/plugin\/sample/$COMPOSER_VENDOR_NAME\/$PLUGIN_SLUG/g"
grep -rl "PrefixConfig" | xargs sed -i "s/PrefixConfig/$PLUGIN_CONFIG_NAMESPACE/g"
grep -rl "PrefixSource" | xargs sed -i "s/PrefixSource/$PLUGIN_SOURCE_NAMESPACE/g"
grep -rl "PrefixCmd" | xargs sed -i "s/PrefixCmd/$PLUGIN_COMMAND_NAMESPACE/g"
# grep -rl "\$prefix_" | xargs sed -i "s/\$prefix_/\$$PLUGIN_VARS_PREFIX/g"
grep -rl "prefix_" | xargs sed -i "s/prefix_/$PLUGIN_VARS_PREFIX/g"
grep -rl "PREFIX_" | xargs sed -i "s/PREFIX_/$PLUGIN_CONSTANTS_PREFIX/g"

echo ""
echo -e "\033[1;32m Your new plugin has been created successfully and is ready for you to start developing \033[0m"
exit 0