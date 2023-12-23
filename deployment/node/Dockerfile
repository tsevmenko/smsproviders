FROM node:latest

# Create app directory
RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app

# Install app dependencies
COPY package.json /usr/src/app/
RUN npm install

# Bundle app source
COPY . /usr/src/app

RUN npm install -g serve
RUN npm run build

EXPOSE 80

CMD ["serve", "-l", "80", "-s", "/usr/src/app/build"]