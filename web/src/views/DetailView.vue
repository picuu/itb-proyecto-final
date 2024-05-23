<template>
    <LayoutSection>
        <div class="offer-detail">
            <div class="offer-detail-header">
                <div class="offer-image">
                    <img :src="offer.image" alt="Offer Image" />
                </div>
                <div class="offer-info">
                    <h1>{{ offer.title }}</h1>
                    <div class="offer-meta">
                        <span>Added by {{ offer.author }}</span>
                        <span>{{ offer.date }}</span>
                    </div>
                    <div class="offer-actions">
                        <button @click="takeOffer">Take up this offer</button>
                    </div>
                    <div class="offer-location">
                        <strong>Location: </strong><a :href="offer.locationLink">{{ offer.location }}</a>
                    </div>
                    <div class="offer-tags">
                        <div v-for="tag in offer.tags" :key="tag" class="tag">{{ tag }}</div>
                    </div>
                </div>
            </div>
            <div class="offer-description">
                <p>{{ offer.description }}</p>
            </div>
        </div>
    </LayoutSection>
</template>

<script>
//fetch the offer from the API 


</script>

<style scoped>
.offer-detail {
    display: flex;
    flex-direction: column;
    background-color: #1e1e1e;
    color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    margin: 20px;
}

.offer-detail-header {
    display: flex;
    gap: 20px;
}

.offer-image img {
    max-width: 200px;
    border-radius: 10px;
}

.offer-info {
    flex: 1;
}

.offer-info h1 {
    font-size: 1.75rem;
    margin-bottom: 10px;
}

.offer-meta {
    font-size: 0.875rem;
    color: #aaaaaa;
    margin-bottom: 20px;
}

.offer-meta span {
    display: block;
}

.offer-actions button {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 20px;
}

.offer-actions button:hover {
    background-color: #0056b3;
}

.offer-location a {
    color: #007bff;
    text-decoration: none;
}

.offer-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.tag {
    background-color: #333333;
    color: #ffffff;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.875rem;
}

.offer-description {
    margin-top: 20px;
    font-size: 1rem;
    line-height: 1.5;
}
</style>