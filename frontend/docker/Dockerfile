FROM node:20

#Working directory
WORKDIR /app

# Copy package and package-lock 
COPY package*.json ./

#Install dependencies
RUN npm install

# Copy frontend directory
COPY . .

# Vite original port
EXPOSE 5173

# npm commands
CMD ["npm", "run", "dev", "--", "--host"]