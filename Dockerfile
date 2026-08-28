# Imagem oficial com PHP + Apache já configurados
FROM php:8.3-apache

# (opcional, mas comum em projetos PHP — não atrapalha se não usar)
RUN a2enmod rewrite

# Copia todos os arquivos do site para a pasta pública do Apache
COPY . /var/www/html/

# Garante que a pasta usada pelo formulário de contato exista e seja gravável
RUN mkdir -p /var/www/html/data \
    && chown -R www-data:www-data /var/www/html/data

# O Render injeta a porta que o serviço deve usar na variável $PORT
# (o Apache, por padrão, só escuta na porta 80) — este script ajusta isso
# antes de iniciar o servidor.
COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]