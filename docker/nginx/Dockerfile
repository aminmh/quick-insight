FROM nginx

#RUN mkdir /etc/nginx/sites-available
#RUN mkdir /etc/nginx/sites-enabled

RUN apt-get update && apt-get install -y iputils-ping procps systemctl lsof openssl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY conf.d/nginx.conf /etc/nginx/conf.d/default.conf
