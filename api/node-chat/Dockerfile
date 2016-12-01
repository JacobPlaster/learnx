FROM node:argon

# Create app directory
RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app

# Bundle app source
COPY ./src /usr/src/app

# Install app dependencies
RUN npm install

EXPOSE 3000

CMD [ "npm", "start" ]
