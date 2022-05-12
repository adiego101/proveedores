FROM debian:stretch

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections
RUN apt-get update && apt-get upgrade -y 
RUN apt-get -y install git apt-utils dialog nano unzip wget curl software-properties-common gnupg2 apt-transport-https lsb-release ca-certificates
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN apt-get update
RUN apt-get install -y php7.4 libapache2-mod-php7.4 php7.4-mysql php7.4-xml php7.4-bcmath php7.4-bz2 php7.4-intl php7.4-gd php7.4-mbstring php7.4-zip php7.4-curl
RUN apt-get clean
RUN wget -O composer-setup.php https://getcomposer.org/installer
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN echo "ServerName RUPAE" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite
COPY ./apache/service/apache.sh /apache.sh
RUN chmod +x /apache.sh
CMD ["/apache.sh"] 

