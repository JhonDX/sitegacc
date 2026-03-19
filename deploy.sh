#!/bin/bash

# Nome do projeto/container/imagem
CONTAINER_NAME="Gacc"
IMAGE_NAME="site"

echo "🚀 Iniciando deploy..."

# 1. Parar container se existir
if [ "$(docker ps -aq -f name=$CONTAINER_NAME)" ]; then
    echo "🛑 Parando container existente..."
    docker stop $CONTAINER_NAME
fi

# 2. Remover container
if [ "$(docker ps -aq -f name=$CONTAINER_NAME)" ]; then
    echo "🗑️ Removendo container existente..."
    docker rm $CONTAINER_NAME
fi

# 3. Remover imagem
if [ "$(docker images -q $IMAGE_NAME)" ]; then
    echo "🧹 Removendo imagem antiga..."
    docker rmi $IMAGE_NAME
fi

# 4. Build da imagem
echo "🔨 Buildando imagem..."
docker build -t $IMAGE_NAME .

# 5. Subir container
echo "📦 Subindo container..."
docker run -d \
    --name $CONTAINER_NAME \
    -p 8080:80 \
    $IMAGE_NAME

echo "✅ Deploy finalizado com sucesso!"