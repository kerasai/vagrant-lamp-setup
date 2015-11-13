<VirtualHost *:{{PORT}}>
        ServerAdmin webmaster@localhost
        {{URL}}
        DocumentRoot {{DOCROOT}}
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        <Directory {{DOCROOT}}>
                AllowOverride All
        </Directory>

</VirtualHost>
