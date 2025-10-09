# 💼 CRM Clients Management

**CRM Clients Management** is an academic web application built with **Symfony 7**.  
It enables the **management of clients and their invoices**, while ensuring **secure authentication** and a **clean architecture** based on **SOLID principles**.

The project also integrates DevOps tools such as **Docker**, **Jenkins**, **Ansible**, **SonarQube**, and can be deployed on **Kubernetes** for cloud environments.

---

## 📦 Project Structure

### Source Code

```
📁 crm-clients-management/code
├── assets/                → Front-end JS, CSS, and controllers
├── migrations/            → Doctrine migrations
├── public/                → Entry point (index.php)
├── src/                   → Backend source code
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
├── templates/             → Twig templates (layouts and views)
├── tests/                 → Unit tests
├── Dockerfile
```

### Infrastructure & DevOps

```
📁 crm-clients-management/infra
├── Ansible/               → Deployment playbooks
│   ├── deploy.yml
│   ├── inventory.ini
├── Jenkinsfile            → Jenkins CI/CD pipeline
├── k8s/                   → Kubernetes YAML manifests
├── nginx/                 → Nginx configuration & Dockerfile
│   └── conf.d/nginx.conf
└── php/                   → PHP-FPM configuration & Docker setup
    ├── config/php.ini
    └── php-fpm.d/www.conf
```

---

## 🚀 Run the Project Locally

### ⚙️ Requirements

- [Git](https://git-scm.com/)  
- [Docker](https://www.docker.com/)  
- [Docker Compose](https://docs.docker.com/compose/)

### ▶️ Startup Commands

```bash
# Clone the repository
git clone https://github.com/yourusername/crm-clients-management.git
cd crm-clients-management

# Build and start containers
docker-compose up --build -f compose.yaml
```

Access the application via 🌐 **http://localhost:80**

---

## 🧠 Development Workflow

- 🏗️ Created **entities** with database and validation constraints  
- 📜 Generated and applied **Doctrine migrations**  
- 🚦 Implemented **controllers** and **routes**  
- 🧩 Followed a **3-layer architecture: Controller → Service → Repository (CSR)**  
- 📝 Created **FormTypes** for structured form handling  
- 🖋️ Designed **Twig templates**, with a **main parent layout** inherited by all other views  
- ✅ Applied **validation constraints** directly within the entities (reused across forms)  
- 📞 Added a **custom validator** to ensure each client has a unique phone number per user  
- 🔗 Used **interfaces** and **autowiring** to enforce the **Dependency Inversion Principle**

---

## 🔒 Security Implementation

- 🔐 Used a **Doctrine user provider** for authentication  
- 🧾 Built a secure **login form**  
- 👥 Implemented **roles** (prepared for future multiple user types)  
- 🛡️ Developed **voters** to ensure that only the correct user can manage a client or invoice  
- 🚫 Secured all **sensitive routes**

> ⚠️ **Important:** Never store passwords in plain text.  
> Use environment variables (`.env`) or secret managers in production.

---

## 🔧 CI/CD with Jenkins & Ansible

The project includes a complete CI/CD pipeline:

- **Jenkins** — for automated builds and testing  
- **SonarQube** — for static code analysis and quality control  
- **Ansible** — for deployment to servers or Kubernetes clusters  

---

## 🛠️ Technologies Used

- [Symfony 7](https://symfony.com/)  
- [MySQL](https://www.mysql.com/)  
- [Doctrine ORM](https://www.doctrine-project.org/)  
- [Docker & Docker Compose](https://www.docker.com/)  
- [Jenkins](https://www.jenkins.io/)  
- [Ansible](https://www.ansible.com/)  
- [SonarQube](https://www.sonarsource.com/)  
- [Kubernetes](https://kubernetes.io/)  

---

## 👨‍💻 Author

- **Aymen Mechida**  
  5th-year Computer Engineering Student  
  EHEI Oujda — Morocco 🇲🇦  

📧 [aymenmechida11@gmail.com](mailto:aymenmechida11@gmail.com)

---

## 📝 License

This is an **academic project**, open for educational use and further improvement.

---
