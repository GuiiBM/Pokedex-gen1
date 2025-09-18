# 💰 Análise de Custos AWS - Pokédex (Atualizada)

## Resumo Executivo
Estimativa de custos atualizada para hospedar a aplicação Pokédex na AWS com arquitetura MPC robusta.

## Arquitetura de Produção

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   CloudFront    │    │   EC2 t3.micro  │    │  RDS db.t3.micro│
│   (CDN + WAF)   │────│   (PHP MPC)     │────│   (MySQL 8.0)   │
└─────────────────┘    └─────────────────┘    └─────────────────┘
         │                       │                       │
         │              ┌─────────────────┐              │
         └──────────────│   ELB + ASG     │──────────────┘
                        │  (Load Balance) │
                        └─────────────────┘
```

## Custos Detalhados (Região US-East-1)

### 1. Compute (EC2)
- **Instância**: t3.micro (2 vCPU, 1GB RAM)
- **Custo On-Demand**: $0.0104/hora = ~$7.50/mês
- **Free Tier**: 750h/mês GRÁTIS (12 meses)
- **Reserved (1 ano)**: $0.0062/hora = ~$4.50/mês

### 2. Banco de Dados (RDS MySQL)
- **Instância**: db.t3.micro (2 vCPU, 1GB RAM)
- **Custo On-Demand**: $0.035/hora = ~$25.20/mês
- **Free Tier**: 750h/mês GRÁTIS (12 meses)
- **Reserved (1 ano)**: $0.0213/hora = ~$15.35/mês
- **Storage**: 20GB gp2 = $2.30/mês
- **Backup**: 20GB = $2.00/mês

### 3. Rede e Segurança
- **Application Load Balancer**: $16.20/mês
- **CloudFront**: $1.00/mês (1TB transfer)
- **Route 53**: $0.50/mês (hosted zone)
- **WAF**: $5.00/mês (proteção básica)

### 4. Armazenamento e Monitoramento
- **EBS gp3**: 20GB = $1.60/mês
- **CloudWatch**: $3.00/mês (logs + métricas)
- **Systems Manager**: GRÁTIS

## Cenários de Custo

### 🆓 Desenvolvimento (Free Tier - 12 meses)
```
EC2 t3.micro:        $0.00/mês
RDS db.t3.micro:     $0.00/mês
Storage (20GB):      $2.30/mês
Backup:              $2.00/mês
CloudWatch:          $0.00/mês (básico)
─────────────────────────────
TOTAL:               $4.30/mês
```

### 💼 Produção Básica (Pós Free Tier)
```
EC2 t3.micro:        $7.50/mês
RDS db.t3.micro:     $25.20/mês
Storage + Backup:    $4.30/mês
Load Balancer:       $16.20/mês
CloudFront + WAF:    $6.00/mês
CloudWatch:          $3.00/mês
─────────────────────────────
TOTAL:               $62.20/mês
```

### 🏆 Produção Otimizada (Reserved Instances)
```
EC2 Reserved:        $4.50/mês
RDS Reserved:        $15.35/mês
Storage + Backup:    $4.30/mês
Load Balancer:       $16.20/mês
CloudFront + WAF:    $6.00/mês
CloudWatch:          $3.00/mês
─────────────────────────────
TOTAL:               $49.35/mês
```

## Alternativas Econômicas

### 1. AWS Lightsail
```
Lightsail 1GB:       $5.00/mês
Managed Database:    $15.00/mês
Load Balancer:       $18.00/mês
─────────────────────────────
TOTAL:               $38.00/mês
```

### 2. Serverless (Lambda + Aurora Serverless)
```
Lambda (1M requests): $0.20/mês
Aurora Serverless v2: $43.20/mês (mínimo)
API Gateway:          $3.50/mês
CloudFront:           $1.00/mês
─────────────────────────────
TOTAL:                $47.90/mês
```

### 3. Container (ECS Fargate)
```
Fargate (0.25 vCPU):  $7.20/mês
RDS db.t3.micro:      $25.20/mês
Application LB:       $16.20/mês
Storage:              $4.30/mês
─────────────────────────────
TOTAL:                $52.90/mês
```

## Otimizações de Custo

### Imediatas
- ✅ **Free Tier**: Economiza $32.70/mês no primeiro ano
- ✅ **Reserved Instances**: Economiza $12.85/mês após free tier
- ✅ **Spot Instances**: Até 70% desconto para dev/test

### Médio Prazo
- 📊 **Auto Scaling**: Reduz custos em baixa demanda
- 🗜️ **Compression**: Reduz transfer costs
- 📦 **S3 para assets**: Cache de imagens locais

### Longo Prazo
- 🏗️ **Savings Plans**: Até 72% desconto
- 🌍 **Multi-Region**: Otimização por região
- 📈 **Right Sizing**: Ajuste baseado em métricas

## Monitoramento de Custos

### Alertas Configurados
- 🚨 **Budget Alert**: $50/mês
- 📊 **Cost Anomaly**: Detecção automática
- 📈 **Usage Reports**: Análise semanal

### Ferramentas
- **Cost Explorer**: Análise detalhada
- **Trusted Advisor**: Recomendações
- **Well-Architected Tool**: Review de arquitetura

## Recomendação Final

### Para Desenvolvimento
**Lightsail**: $5/mês (mais simples)

### Para Produção
**EC2 + RDS com Reserved**: $49.35/mês (mais controle)

### Para Escala
**ECS Fargate + Aurora**: $52.90/mês (mais escalável)

## Calculadora AWS
🔗 https://calculator.aws/#/estimate

**Última atualização**: Setembro 2025
**Região base**: US-East-1 (N. Virginia)
