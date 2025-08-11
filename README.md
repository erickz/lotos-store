# Lottery Bolões E-commerce Platform

## Overview
This platform is a comprehensive e-commerce solution for creating, managing, and selling lottery bolões (betting pools) for the Brazilian Federal Lottery. The system automates the entire process from bolão creation to result verification, with integrated payment processing and Chrome extension support.

## Key Features

### Core Functionality
- **Bolão Management**
  - Create and manage lottery bolões with custom configurations
  - Automatic generation of betting slips
  - Demo game creation for testing purposes

### Result Processing
- **Automatic Verification**
  - Integration with official lottery APIs for real-time results
  - Custom commands for result verification and prize distribution
  - Automatic winner detection and notification

### E-commerce Operations
- **Cota (Share) System**
  - Sell fractional shares in bolões
  - Dynamic pricing and share allocation
- **Payment Gateway**
  - Credit card processing (PCI-compliant)
  - PIX (Brazilian instant payment) integration
  - Automated payment confirmation and reconciliation

### Automation Systems
- **Laravel Scheduler**
  - Automatic contest creation based on lottery schedules
  - Regular maintenance tasks to update data
- **Custom Artisan Commands**
  - `check:boloes-of-day` - Check and verify of the boloes according the concursos
  - `check:concursos-of-day` - Loop the active loteries and insert the daily drawn informations of the concursos
  - `check:pending-concursos` - Get all the pending concursos and update their draw informations
  - `create:boloes-suggestions` - Create suggestions models and register It
  - `create:concursos-for-week` - Create the weekly concursos
  - `create:demo-boloes-for-week` - Create bolões for the concursos of the week in order to have the listing of boloes not empty all times
  - `crud:generator {name : Class (singular) for example User}` - Build the CRUD by generating a set of files

### Integration API
- **RESTful API (No Authentication)**
  - Endpoints for Chrome extension integration
  - Supports bot operations on official lottery sites
  - JSON-based communication for game creation automation

## Technology Stack
- **Backend**: Laravel 9.1
- **Frontend**: Blade templates, Sass, Javascript
- **Database**: MySQL 8.x
- **Payment Processors**: Pagbank (credit card and PIX)
- **Chrome Extension**: Manifest V3

### Prerequisites
- PHP 8.0+
- MySQL 8.x