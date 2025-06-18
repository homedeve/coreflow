# Coreflow — Laravel Clean Architecture & DDD Toolkit

**Coreflow** est un package Laravel développé par [Homedeve](https://homedeve.com), conçu pour générer automatiquement une structure DDD + Clean Architecture dans vos projets Laravel, sans casser les conventions natives du framework. Il propose aussi des commandes Artisan pour accélérer la création des fichiers métier.

---

## 🚀 Fonctionnalités principales

- `php artisan coreflow:install` → met en place l’arborescence complète (core/, infrastructure/, etc.)
- `php artisan make:entity User` → génère une entité métier dans `core/Domain/...`
- `php artisan make:usecase CreateUser` → génère un use case prêt à l’emploi
- `php artisan make:dto UserData` → génère un DTO associé à un cas d’usage
- `php artisan make:repository UserRepository` → génère l’interface + stub Eloquent
- Et plus encore à venir !

---

## 📁 Arborescence générée

```text
project-root/
├── src/
│   ├── Domain/
    │   ├── Domain1/
                  ├── Entities/
                  ├── Repositories/
                  └── ValueObjects/
│   ├── Application/
│   │   ├── DTOs/
│   │   ├── UseCases/
│   │   └── Services/
│   └── Shared/
│       ├── Exceptions/
│       └── Interfaces/
    ├── infrastructure/
    │   ├── Persistence/
    │   ├── Pdf/
    │   └── Notifications/
    ├── app/
    │   └── Providers/CoreflowServiceProvider.php
```

---

## 📦 Installation (à venir sur Packagist)

```bash
composer require homedeve/coreflow
php artisan coreflow:install
```

---

## ✅ Objectifs atteints

- Respect total des principes Clean Architecture
- Compatible 100 % Laravel
- Dossiers et fichiers en anglais uniquement
- Fichier `README.md` inclus dans chaque sous-dossier si besoin

---

## 🛠️ Commandes Artisan prévues (Roadmap)

| Commande                  | Description                            |
| ------------------------- | -------------------------------------- |
| `coreflow:install`        | Initialise le squelette complet        |
| `make:entity`             | Crée une entité métier                 |
| `make:dto`                | Crée un DTO                            |
| `make:usecase`            | Crée un Use Case                       |
| `make:repository`         | Crée une interface + stub              |
| `coreflow:bind` (à venir) | Lie une interface à son implémentation |

---

## 📘 Licence

Projet open source sous licence MIT.

Développé avec ❤️ par Homedeve et Camel Djoulako.
