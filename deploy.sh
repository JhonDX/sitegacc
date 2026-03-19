#!/bin/bash

echo "🚀 Iniciando deploy..."

# Derruba containers (sem apagar imagem)
echo "🛑 Parando containers..."
docker compose down

# Sobe novamente (sem rebuild pesado)
echo "🔨 Subindo containers..."
docker compose up -d

echo "✅ Deploy finalizado!"