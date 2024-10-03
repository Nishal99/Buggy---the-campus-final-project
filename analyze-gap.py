import sys
import json
import re
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.cluster import KMeans
import nltk
import numpy as np

# Ensure you have downloaded the necessary NLTK data files
nltk.download('punkt', quiet=True)
nltk.download('stopwords', quiet=True)

def preprocess_text(text):
    # Remove HTML tags
    text = re.sub(r'<.*?>', '', text)
    # Tokenize text
    tokens = word_tokenize(text)
    # Convert to lower case
    tokens = [token.lower() for token in tokens]
    # Remove stop words and non-alphabetic tokens
    stop_words = set(stopwords.words('english'))
    tokens = [token for token in tokens if token.isalpha() and token not in stop_words]
    return ' '.join(tokens)

def preprocess_data(data):
    preprocessed_questions = []
    for question in data:
        preprocessed_question = preprocess_text(question)
        preprocessed_questions.append(preprocessed_question)
    return preprocessed_questions

def perform_clustering(preprocessed_questions, num_clusters=3):
    # Convert the text data to numerical format using TF-IDF
    vectorizer = TfidfVectorizer()
    X = vectorizer.fit_transform(preprocessed_questions)

    # Apply K-means clustering
    kmeans = KMeans(n_clusters=num_clusters, random_state=42)
    kmeans.fit(X)
    
    return kmeans, vectorizer, X

def interpret_clusters(kmeans, vectorizer, X, preprocessed_questions, original_data):
    cluster_labels = kmeans.labels_
    terms = vectorizer.get_feature_names_out()

    # Get the top terms for each cluster
    order_centroids = kmeans.cluster_centers_.argsort()[:, ::-1]
    cluster_terms = {}
    for i in range(kmeans.n_clusters):
        top_terms = [terms[ind] for ind in order_centroids[i, :10]]  # Top 10 terms for each cluster
        cluster_terms[i] = top_terms

    # Identify the highest frequency cluster
    cluster_sizes = np.bincount(cluster_labels)
    highest_frequency_cluster = np.argmax(cluster_sizes)

    knowledge_gaps = {
        highest_frequency_cluster: [original_data[i]['category'] for i in range(len(original_data)) if cluster_labels[i] == highest_frequency_cluster]
    }

    return knowledge_gaps

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python test.py <input_file>")
        sys.exit(1)

    input_file = sys.argv[1]
    with open(input_file, 'r') as file:
        click_history_json = file.read()

    try:
        click_history_data = json.loads(click_history_json)
        click_history = [record['keyword'] for record in click_history_data]
        categories = [record['category'] for record in click_history_data]
    except json.JSONDecodeError:
        print("Error: Invalid JSON data")
        sys.exit(1)

    preprocessed_questions = preprocess_data(click_history)
    kmeans, vectorizer, X = perform_clustering(preprocessed_questions)

    knowledge_gaps = interpret_clusters(kmeans, vectorizer, X, preprocessed_questions, click_history_data)
    for cluster, categories in knowledge_gaps.items():
        for category in categories:
            print(category)
            