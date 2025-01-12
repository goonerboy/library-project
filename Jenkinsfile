pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                script {
                    // Команды для сборки твоего проекта
                    echo 'Building project...'
                }
            }
        }
        stage('Test') {
            steps {
                script {
                    // Команды для тестирования проекта
                    echo 'Running tests...'
                }
            }
        }
        stage('Deploy') {
            steps {
                script {
                    // Команды для деплоя проекта
                    echo 'Deploying project...'
                }
            }
        }
    }

    post {
        success {
            echo 'Build and deploy completed successfully!'
        }
        failure {
            echo 'Build or deploy failed!'
        }
    }
}
