
# 💼 CRM Clients Management

CRM Clients Management est une application web académique développée avec **Symfony 7**.  
Elle permet la **gestion des clients et de leurs factures**, tout en assurant une **authentification sécurisée** et une architecture propre basée sur les **principes SOLID**.

Le projet intègre des outils DevOps tels que **Docker**, **Jenkins**, **Ansible**, **SonarQube**, et peut être déployé en **Kubernetes** pour des environnements cloud.

---

## 📦 Structure du projet

### Code source

```
📁 crm-clients-management/code
├── assets/                → JS, CSS et controllers front-end
│   ├── app.js
│   ├── bootstrap.js
│   ├── controllers/
│   └── styles/
├── migrations/            → Doctrine migrations
├── public/                → Point d’entrée index.php
├── src/                   → Code backend
│   ├── Contract/
│   │   ├── Repository/
│   │   └── Service/
│   ├── Controller/
│   ├── Entity/
│   ├── Enum/
│   ├── EventSubscribers/
│   ├── Form/
│   │   ├── Type/
│   │   └── Validator/
│   ├── Repository/
│   ├── Security/
│   │   └── Voter/
│   └── Service/
├── templates/             → Fichiers Twig (layouts et vues)
├── tests/                 → Tests unitaires
├── Dockerfile
```

### Infrastructure & DevOps

```
📁 crm-clients-management/infra
├── Ansible/               → Playbooks pour déploiement
│   ├── deploy.yml
│   ├── inventory.ini
├── Jenkinsfile            → Pipeline CI/CD Jenkins
├── k8s/                   → YAML pour Kubernetes
├── nginx/                 → Configuration Nginx et Dockerfile
│   └── conf.d/nginx.conf
└── php/                   → Configuration PHP-FPM et Docker
    ├── config/php.ini
    └── php-fpm.d/www.conf
```

---

## 🚀 Lancer le projet en local

### ⚙️ Prérequis

- [Git](https://git-scm.com/)  
- [Docker](https://www.docker.com/)  
- [Docker Compose](https://docs.docker.com/compose/)  

### ▶️ Commandes de démarrage

```bash
# Cloner le projet
git clone https://github.com/yourusername/crm-clients-management.git
cd crm-clients-management

# Lancer les conteneurs Docker
docker-compose up --build -f compose.yaml
```

Accédez à l’application via : 🌐 **http://localhost:80**

---

### Développement (Code)

- 🏗️ Création des **entités** avec contraintes (Entity)  
- 📜 Génération des **migrations** et application sur la base de données  
- 🚦 Création des **contrôleurs** et **routes**  
- 🧩 Architecture **3 couches : Controller, Service, Repository (CSR)**  
- 📝 Création des **FormTypes** pour les formulaires  
- 🖋️ Développement des **templates Twig**, avec un **template parent pour l’utilisateur** et héritage pour les autres vues  
- ✅ Mise en place des **contraintes de validation** directement sur les entités  
- 📞 **Validation personnalisée** pour s’assurer que chaque client possède un numéro de téléphone unique par utilisateur  
- 🔗 Utilisation des **interfaces** et de l’**autowiring** pour appliquer le principe d’inversion de dépendance (Dependency Inversion Principle)

### Sécurité

- 🔐 Utilisation d’un **provider Doctrine** pour l’authentification  
- 🧾 Formulaire de **login sécurisé**  
- 👥 Gestion des **rôles** (même si actuellement un seul type d’utilisateur, pour des évolutions futures)  
- 🛡️ Utilisation de **voters** pour s’assurer qu’un client ou une facture ne peut être manipulé que par le bon utilisateur  
- 🔒 Protection des **routes sensibles**

> ⚠️ **Évitez de stocker les mots de passe en clair.**  
> Utilisez un fichier `.env` ou un gestionnaire de secrets pour la production.

---

## 🔧 CI/CD avec Jenkins & Ansible

Le projet inclut un pipeline CI/CD :

- **Jenkins** pour automatiser le build et les tests  
- **SonarQube** pour analyser la qualité du code  
- **Ansible** pour déployer l’application sur un serveur distant ou en Kubernetes  

---

## 🛠️ Technologies utilisées

- [Symfony 7](https://symfony.com/)  
- [MySQL](https://www.mysql.com/)  
- [Doctrine ORM](https://www.doctrine-project.org/)  
- [Docker & Docker Compose](https://www.docker.com/)  
- [Jenkins](https://www.jenkins.io/)  
- [Ansible](https://www.ansible.com/)  
- [SonarQube](https://www.sonarsource.com/)  
- [Kubernetes](https://kubernetes.io/)  

---

## 👨‍💻 Auteur

- **Aymen Mechida**  
  Étudiant en 5ème année cycle ingénieur en informatique  
  EHEI Oujda — Maroc 🇲🇦  

📧 [aymenmechida11@gmail.com](aymenmechida11@gmail.com)  

---

## 📝 Licence

Ce projet est un **projet académique** libre d’utilisation et d’évolution pour des fins éducatives.

---
