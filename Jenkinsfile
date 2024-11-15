pipeline {
    agent any
    triggers {
        githubPush()
    }

    stages {
        stage('Build') {
            steps {
                script {
                    // Membangun image Docker
                    sh 'docker build -t aditbest5/fullstack-test .'
                }
            }
        }

        stage('Deliver') {
            steps {
                script {
                    // Menghentikan dan menghapus container yang berjalan, jika ada
                    sh 'docker container stop fullstack-test-container || true'
                    sh 'docker container rm fullstack-test-container || true'

                    // Menjalankan container baru dalam mode detached (-d)
                    sh 'docker run -d --name fullstack-test-container -p 8801:8801 aditbest5/fullstack-test &'
                }
            }
        }
    }

    post {
        always {
            script {
                // Membersihkan image yang tidak digunakan
                sh 'docker image prune -f || true'
            }
        }
    }
}