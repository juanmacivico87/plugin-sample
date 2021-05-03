#!/usr/bin/env bash
echo -e "\033[1;34m ##################################################### \033[0m"
echo -e "\033[1;34m # Plugin sample for WordPress development           # \033[0m"
echo -e "\033[1;34m #                                                   # \033[0m"
echo -e "\033[1;34m # Author:   juanmacivico87                          # \033[0m"
echo -e "\033[1;34m # Website:  https://www.juanmacivico87.com          # \033[0m"
echo -e "\033[1;34m # GitHub:   https://www.github.com/juanmacivico87   # \033[0m"
echo -e "\033[1;34m ##################################################### \033[0m"

echo ""
echo -e "\033[1;32m Please, enter a name for your new plugin (for example: 'My Awesome Plugin') \033[0m"
echo ""
echo -e "\033[1;31m Remember that if the name of the plugin contains more than one word, it must be enclosed in single quotes \033[0m"
echo ""
read PLUGIN_NAME

echo ""
echo -e "\033[1;32m Now, enter a description for your new plugin (for example: 'This plugin allows you to live an awesome experience') \033[0m"
echo ""
echo -e "\033[1;31m Remember that if the description of the plugin contains more than one word, it must be enclosed in single quotes \033[0m"
echo ""
read PLUGIN_DESCRIPTION

echo ""
echo -e "\033[1;32m Enter a slug for your new plugin (for example: 'my-awesome-plugin') \033[0m"
echo ""
echo -e "\033[1;31m Remember that it should always be lower case and separate the words by hyphens \033[0m"
echo ""
read PLUGIN_SLUG

echo ""
echo -e "\033[1;32m Enter the URI of the plugin (for example: 'https:\/\/www.myawesomeplugin.com') \033[0m"
echo ""
echo -e "\033[1;31m Remember that you must enclose the URI in single quotes and for each slash (/), use a backslash (\). Otherwise the URI will not be set correctly in the headers of the plugin \033[0m"
echo ""
read PLUGIN_URI

echo ""
echo -e "\033[1;32m It's time for everyone to know who has developed this plugin, so enter your name or your brand name \033[0m"
echo ""
echo -e "\033[1;31m Remember that if your name contains more than one word, it must be enclosed in single quotes \033[0m"
echo ""
read PLUGIN_AUTHOR

echo ""
echo -e "\033[1;32m Enter the URL of your website (for example: 'https:\/\/www.juanmacivico87.com') \033[0m"
echo ""
echo -e "\033[1;31m Remember that you must enclose the URI in single quotes and for each slash (/), use a backslash (\). Otherwise the URI will not be set correctly in the headers of the plugin \033[0m"
echo ""
read PLUGIN_AUTHOR_URI

echo ""
echo -e "\033[1;34m Well, we already have the information for the headers of the plugin. Now we are going to establish the rest of the information you need to develop your plugin \033[0m"

echo ""
echo -e "\033[1;32m First, enter the name of the composer vendor (for example: my-vendor-name). This information will be set in the composer.json file of your plugin \033[0m"
echo ""
echo -e "\033[1;31m Remember that it should always be lower case and separate the words by hyphens \033[0m"
echo ""
read COMPOSER_VENDOR_NAME

echo ""
echo -e "\033[1;32m Now comes the turn of the namespaces for the classes of your plugin. We start with the one in the configuration directory (for example: MyAwesomeConfig) \033[0m"
echo ""
echo -e "\033[1;31m Remember that the namespace must not be separated by spaces and that an UpperCamelCase structure must be used to define it \033[0m"
echo ""
read PLUGIN_CONFIG_NAMESPACE

echo ""
echo -e "\033[1;32m We will continue with the namespace of the classes in the source directory (for example: MyAwesomeSrc) \033[0m"
echo ""
echo -e "\033[1;31m Remember that the namespace must not be separated by spaces and that an UpperCamelCase structure must be used to define it \033[0m"
echo ""
read PLUGIN_SOURCE_NAMESPACE

echo ""
echo -e "\033[1;32m And finally, enter the namespace of the command classes (for example: MyAwesomeCmd). In this way, you can also write your own commands if you need it \033[0m"
echo ""
echo -e "\033[1;31m Remember that the namespace must not be separated by spaces and that an UpperCamelCase structure must be used to define it \033[0m"
echo ""
read PLUGIN_COMMAND_NAMESPACE

echo ""
echo -e "\033[1;34m Ok, we are almost done. Now you just need to enter a prefix for global functions and variables, and also for global constants \033[0m"

echo ""
echo -e "\033[1;32m Enter the prefix for functions and variables (for example: my_awesome_) \033[0m"
echo ""
echo -e "\033[1;31m Remember that it should always be lower case and separate the words by underscores \033[0m"
echo ""
read PLUGIN_VARS_PREFIX

echo ""
echo -e "\033[1;32m Enter the prefix for constants (for example: MY_AWESOME_) \033[0m"
echo ""
echo -e "\033[1;31m Remember that it should always be upper case and separate the words by underscores \033[0m"
echo ""
read PLUGIN_CONSTANTS_PREFIX

echo ""
echo -e "\033[1;34m Okay, that's it. Let's go there. Start plugin configuration!!! \033[0m"

# cd "$(dirname "$0")"
# source create.data
cd ../..

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
read CLOSE